<template>
    <AppLayout>
        <HeaderComponent title="Product" subtitle="Create Product Record" />
        <form @submit.prevent="submit">
            <div class="row">
                <InputComponent id="name" label="Product Name" v-model="form.name" :error="form.errors.name"
                    :isRequired="true" />
                <InputComponent id="price" placeholder="ex:750.00" label="Product Price" v-model="form.price"
                    :error="form.errors.price" :isRequired="true" />
                <TextAreaComponent id="description" label="Description" v-model="form.description"
                    :error="form.errors.description" :isRequired="true" />
                <StatusComponent id="status" label="Status" v-model="form.status" :error="form.errors.status"
                    :isRequired="false" />
            </div>
            <div class="mt-5">
                <Link class="btn btn-outline-danger py-1 px-5" :href="route('products.index')">Cancel</Link>
                <button type="submit" class="btn btn-primary ms-2 py-1 px-5" :disabled="form.processing">
                    Create Product
                </button>
            </div>
        </form>
    </AppLayout>
</template>

<script>
import HeaderComponent from '@/Components/HeaderComponent.vue';
import InputComponent from '@/Components/InputComponent.vue';
import SelectComponent from '@/Components/SelectComponent.vue';
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
                description: '',
                price: '',
                status: 1,
            })
        }
    },
    mounted() {

    },
    methods: {
        submit() {
            this.form.post(route('products.store'), {
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
                        title: "Product Saved",
                        text: "Product has been saved successfully.",
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

<style></style>