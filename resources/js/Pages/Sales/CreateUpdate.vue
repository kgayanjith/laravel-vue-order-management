<template>
    <AppLayout>
        <form @submit.prevent="submit">
            <div class="row">
                <div class="col-md-6">
                    <SelectComponent class="col-md-12" id="customer" label="Customer" :options="customers"
                        v-model="form.order.customer_id" :error="form.errors.customer" />
                    <InputComponent class="col-md-12 mb-3" id="address1" label="Address Line 1"
                        v-model="form.addressline1" disabled />
                    <InputComponent class="col-md-12 mb-3" id="address2" label="Address Line 2"
                        v-model="form.addressline2" disabled />
                    <InputComponent class="col-md-12 mb-3" id="address3" label="Address Line 3"
                        v-model="form.addressline3" disabled />
                    <InputComponent class="col-md-12 mb-3" id="suburb" label="Suburb" v-model="form.suburb" disabled />
                    <InputComponent class="col-md-12 mb-3" id="state" label="State/Province" v-model="form.state"
                        disabled />
                    <InputComponent class="col-md-12 mb-3" id="postal" label="Postal Code" v-model="form.postalcode"
                        disabled />
                </div>
                <div class="col-md-6">
                    <InputComponent class="col-md-12 mb-3" id="address1" label="Invoice No"
                        v-model="form.order.invoiceNo" />
                    <InputComponent class="col-md-12 mb-3" type="date" id="address1" label="Invoice Date"
                        v-model="form.order.invoiceDate" />
                    <InputComponent class="col-md-12 mb-3" id="address1" label="Reference No"
                        v-model="form.order.referenceNo" />
                    <TextAreaComponent class="col-md-12" id="note" rows="5" label="Note" v-model="form.order.note" />
                </div>

            </div>

            <div class="table-responsive mt-5">
                <table class="table" id="productsTable">
                    <thead class="">
                        <tr class="text-center">
                            <th class="fw-bold" scope="col">Item Code</th>
                            <th class="fw-bold" scope="col">Description</th>
                            <th class="fw-bold" scope="col">Note</th>
                            <th class="fw-bold" scope="col">Quantity</th>
                            <th class="fw-bold" scope="col">Price</th>
                            <th class="fw-bold" scope="col">Tax</th>
                            <th class="fw-bold" scope="col">Excl Amount</th>
                            <th class="fw-bold" scope="col">Tax Amount</th>
                            <th class="fw-bold" scope="col">Incl Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <SelectComponent class="col-md-12 mt-4" id="product_id"
                                    :options="products.map(p => ({ id: p.id, name: p.code }))"
                                    v-model="form.order.product_id" :error="form.errors.product_id" />
                            </td>
                            <td>
                                <SelectComponent class="col-md-12 mt-4" id="product_description"
                                    :options="products.map(p => ({ id: p.id, name: p.description }))"
                                    v-model="form.order.product_id" :error="form.errors.product_id" />
                            </td>
                            <td>
                                <InputComponent class="col-md-12 mb-3" id="address3" v-model="form.order.product_note"
                                    :isRequired="false" />
                            </td>
                            <td>
                                <InputComponent class="col-md-12 mb-3" id="address3"  @input="taxCalulate" v-model="form.order.quantity"
                                    :isRequired="false" />
                            </td>
                            <td>
                                <InputComponent class="col-md-12 mb-3" id="price" v-model="form.order.price"
                                    :isRequired="false" />
                            </td>
                            <td>
                                <InputComponent class="col-md-12 mb-3" id="address3" @input="taxCalulate" v-model="form.order.tax"
                                    :isRequired="false" placeholder="ex:10%" />
                            </td>
                            <td>
                                <InputComponent class="col-md-12 mb-3" id="address3" v-model="form.order.excl_amount"
                                    :isRequired="false" disabled />
                            </td>
                            <td>
                                <InputComponent class="col-md-12 mb-3" id="address3" v-model="form.order.tax_amount"
                                    :isRequired="false" disabled />
                            </td>
                            <td>
                                <InputComponent class="col-md-12 mb-3" id="address3" v-model="form.order.incl_amount"
                                    :isRequired="false" disabled />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-5">
                <Link class="btn btn-outline-danger py-1 px-5" :href="route('home')">Cancel</Link>
                <button type="submit" class="btn btn-primary ms-2 py-1 px-5" :disabled="form.processing">
                    Create Product
                </button>
            </div>
        </form>
    </AppLayout>
</template>

<script>
import InputComponent from '@/Components/InputComponent.vue';
import SelectComponent from '@/Components/SelectComponent.vue';
import StatusComponent from '@/Components/StatusComponent.vue';
import TextAreaComponent from '@/Components/TextAreaComponent.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';


export default {
    components: {
        AppLayout,
        InputComponent,
        TextAreaComponent,
        StatusComponent,
        Link,
        SelectComponent
    },
    props: {
        customers: Array,
        products: Array
    },
    data() {
        return {
            form: useForm({

                addressline1: '',
                addressline2: '',
                addressline3: '',
                suburb: '',
                state: '',
                postalcode: '',
                status: 1,

                order: {
                    customer_id: '',
                    invoiceNo: '',
                    invoiceDate: '',
                    referenceNo: '',
                    note: '',
                    product_note: '',
                    quantity: '',
                    tax: '',
                    excl_amount: '',
                    tax_amount: '',
                    incl_amount: '',
                    product_description: '',
                    product_id: '',
                    price: '',
                },
            })
        }
    },
    watch: {

        'form.order.customer_id'(id) {
            // console.log(id);
            const c = this.customers.find(x => String(x.id) === String(id));

            if (!c) return;
            const parts = (c.address ?? '')
                .split(',')
                .map(s => s.trim());

            // console.log(parts.length);

            this.form.addressline1 = parts[0] ?? '';
            this.form.addressline2 = parts[1] ?? '';
            this.form.addressline3 = parts[2] ?? '';

            this.form.suburb = c.suburb ?? '';
            this.form.state = c.state ?? '';
            this.form.postalcode = c.postalcode ?? '';

        },
        'form.order.product_id'(id) {
            const p = this.products.find(x => String(x.id) === String(id));
            
            this.form.order.product_description = p?.description ?? '';
            this.form.order.price = p?.price ?? '';
        },

        'form.order.quantity'(quantity) {
             
            this.taxCalulate();   
        }

    },
    mounted() {
    },
    methods: {
        taxCalulate() {

            const quantity = parseFloat(this.form.order.quantity) || '';
            const price = parseFloat(this.form.order.price) || '';
            const taxRate = parseFloat(this.form.order.tax) || '';

            const exclAmount = quantity * price;
            const taxAmount = exclAmount * (taxRate / 100);
            const inclAmount = exclAmount + taxAmount;

            this.form.order.excl_amount = exclAmount.toFixed(2);
            this.form.order.tax_amount = taxAmount.toFixed(2);
            this.form.order.incl_amount = inclAmount.toFixed(2);
        },
        submit() {
            this.form.post(route('sales.store'), {
                onSuccess: () => {
                    this.form.reset();
                    alert('Order created successfully!');
                },
                onError: () => {
                    alert('There were errors while creating the product.');
                    console.log(this.form.errors);
                }
            });
        },

    }
}
</script>

<style></style>