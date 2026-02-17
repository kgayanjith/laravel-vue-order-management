<template>
    <AppLayout>
        <HeaderComponent title="Customer" subtitle="Create Customer Record" />
        <form @submit.prevent="submit">
            <div class="row">
                <div class="col-md-6">
                    <InputComponent class="col-md-12 mb-3" id="name" label="Customer Name" v-model="form.name"
                        :error="form.errors.name" :isRequired="true" />
                    <InputComponent class="col-md-12 mb-3" id="address1" label="Address Line 1"
                        v-model="form.addressline1" :error="form.errors.addressline1" :isRequired="true"
                        placeholder="55" />
                    <InputComponent class="col-md-12 mb-3" id="address2" label="Address Line 2"
                        v-model="form.addressline2" :error="form.errors.addressline2" :isRequired="true"
                        placeholder="Test street" />
                    <InputComponent class="col-md-12 mb-3" id="address3" label="Address Line 3"
                        v-model="form.addressline3" :error="form.errors.addressline3" :isRequired="true"
                        placeholder="Sample City" />
                    <StatusComponent id="status" label="Status" v-model="form.status" :error="form.errors.status"
                        :isRequired="false" />
                </div>
                <div class="col-md-6">
                    <InputComponent class="col-md-12 mb-3" id="phone" label="Telephone No" placeholder="ex:0771603456"
                        v-model="form.phone" :error="form.errors.phone" :isRequired="true" @change="onlyNumbers" />
                    <InputComponent class="col-md-12 mb-3" id="suburb" label="Suburb" v-model="form.suburb"
                        :error="form.errors.suburb" :isRequired="true" />
                    <InputComponent class="col-md-12 mb-3" id="state" label="State/Province" v-model="form.state"
                        :error="form.errors.state" :isRequired="true" />
                    <InputComponent class="col-md-12 mb-3" id="postal" label="Postal Code" v-model="form.postalcode"
                        :error="form.errors.postalcode" :isRequired="true" placeholder="00000" />
                </div>
            </div>

            <div class="mt-5">
                <Link class="btn btn-outline-danger py-1 px-5" :href="route('customers.index')">Cancel</Link>
                <button type="submit" class="btn btn-primary ms-2 py-1 px-5" :disabled="form.processing">
                    Create Customer
                </button>
            </div>
        </form>
    </AppLayout>
</template>

<script>
import HeaderComponent from '@/Components/HeaderComponent.vue';
import InputComponent from '@/Components/InputComponent.vue';
import StatusComponent from '@/Components/StatusComponent.vue';
import TextAreaComponent from '@/Components/TextAreaComponent.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';



export default {
    components: {
        AppLayout,
        InputComponent,
        TextAreaComponent,
        StatusComponent,
        Link,
        HeaderComponent
    },
    data() {
        return {
            form: useForm({
                id: '',
                name: '',
                addressline1: '',
                addressline2: '',
                addressline3: '',
                suburb: '',
                state: '',
                postalcode: '',
                phone: '',
                status: 1,
            })
        }
    },
    watch: {

    },
    mounted() {

    },
    methods: {

        submit() {

            this.form.post(route('customers.store'), {
                onSuccess: () => {
                    this.form.reset();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        },
                    });
                    Toast.fire({
                        icon: "success",
                        title: "Customer Saved",
                        text: "Customer has been saved successfully.",
                        iconColor: "#2563eb",
                        customClass: {
                            timerProgressBar: "custom-timer-bar",
                        },
                    });
                },
                onError: () => {
                    const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            },
                        });
                        Toast.fire({
                            icon: "error",
                            title: "Error!",
                            text: "Something went wrong!",
                            iconColor: "#2563eb",
                            customClass: {
                                timerProgressBar: "custom-timer-bar",
                            },
                        });
                }
            });



        }
    }
}
</script>

<style scoped></style>