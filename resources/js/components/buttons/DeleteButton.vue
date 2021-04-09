<template>
    <button
        @click="sendMessageFromDeleteButton()"
        v-model="deleteId"
        class="w-20 ml-3 rounded px-3 py-1 bg-red-300 hover:bg-red-700 disabled:opacity-50 hover:text-white focus:shadow-outline focus:outline-none"
    >
        <slot></slot>
    </button>
</template>
<script>
export default {
    name: 'DeleteButton',
    props: {
        deleteId: {
            type: Number,
            required: true
        },
    },
    methods: {
        sendMessageFromDeleteButton() {
            this.$emit('messageFromDeleteButton', this.deleteId);
        }
    }
}
</script>
