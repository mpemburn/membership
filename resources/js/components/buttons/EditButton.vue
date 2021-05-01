<template>
    <button
        @click="sendMessageFromEditButton()"
        v-model="editId"
        class="w-20 ml-3 rounded px-3 py-1 bg-green-300 hover:bg-green-700 disabled:opacity-50 hover:text-white focus:shadow-outline focus:outline-none"
        :disabled="disabled"
    >
        <slot></slot>
    </button>
</template>
<script>
export default {
    name: 'EditButton',
    props: {
        editId: {
            type: Number,
            required: true
        },
        disabled: {
            type: Boolean,
            required: false
        }
    },
    methods: {
        sendMessageFromEditButton() {
            this.$emit('messageFromEditButton', this.editId);
        }
    }
}
</script>
