<template>
  <AppLayout>
    <InputComponent label="name" :isRequired="false" type="text" />
  </AppLayout>
</template>

<script>
import InputComponent from '@/Components/InputComponent.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
  components: {
    AppLayout,
    InputComponent
  },
}
</script>

<style></style>