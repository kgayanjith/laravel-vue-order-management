<template>
    <AppLayout>
        <form @submit.prevent="submit">
            <div class="row">
                <InputComponent id="name" label="Product Name" v-model="form.name" :error="form.errors.name"
                    :isRequired="true" />
                <InputComponent id="price" placeholder="ex:750.00" label="Product Price" v-model="form.price" :error="form.errors.price"
                    :isRequired="true" />
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
import InputComponent from '@/Components/InputComponent.vue';
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
        Link
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
    watch: {
        'form.name'(value) {
            this.form.slug = this.slugify(value);
        }
    },
    methods: {
        slugify(text) {
            return text
                .toString()
                .toLowerCase()
                .trim()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-');
        },
        submit() {
            this.form.post(route('products.store'), {
                onSuccess: () => {
                    this.form.reset();
                    alert('Product created successfully!');
                },
                onError: () => {
                    alert('There were errors while creating the product.');
                }
            });
        }
    }
}
</script>

<style></style>