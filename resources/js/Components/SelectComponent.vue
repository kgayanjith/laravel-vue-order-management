<template>
    <div class="row mb-3">
        <div :class="class">
            <label class="form-label" :for="id">
                {{ label }} <sup class="text-danger" v-if="isRequired">*</sup>
            </label>

            <select :id="id" class="form-select form-control" :multiple="isMultiple">
                <option value="">-- Select --</option>
                <option v-for="option in options" :key="option.id" :value="option.id">
                    {{ option.name }}
                </option>
            </select>

            <div class="text-danger">{{ error }}</div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        id: String,
        label: String,
        error: String,
        isRequired: Boolean,
        isMultiple: Boolean,
        options: { type: Array, default: () => [] },
        modelValue: { type: [String, Number, Array, null], default: "" },
        class: {
            type: String,
            default: "mb-3 col-md-6",
        },
    },
    emits: ["update:modelValue"],

    mounted() {
        const el = $("#" + this.id);

        el.select2();
        el.val(this.modelValue).trigger("change.select2");
        el.on("change", () => {
            this.$emit("update:modelValue", el.val());
        });
    },

    watch: {
        modelValue(v) {
            $("#" + this.id).val(v).trigger("change.select2");
        },
    },

    beforeUnmount() {
        const el = $("#" + this.id);
        el.off("change");
        el.select2("destroy");
    },
};
</script>
<style scoped>

</style>
