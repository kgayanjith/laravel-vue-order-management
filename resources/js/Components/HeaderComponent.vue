<template>
    <div class="mb-5">
        <h4 class="fw-bold ">{{ title }}</h4>
        <p>{{ subtitle }}</p>
    </div>
</template>

<script>
export default {
    props: {
        title: String,
        subtitle: String,
    },
}
</script>

<style></style>