<template>
</template>

<script>
export default {
    data() {
        return {
            open: true,
        };
    },
    props: {
        title: {
            type: String,
            default: "",
        },
        header: {
            type: String,
            required: false,
            default: "",
        },
        width: {
            type: String,
            default: "full",
            validator: (value) => ["xs", "sm", "md", "lg", "full"].indexOf(value) !== -1,
        },
    },
    methods: {
        close() {
            this.open = false;
            this.$emit("closeModal");
        },
    },
    computed: {
        maxWidth() {
            switch (this.width) {
                case "xs":
                    return "max-w-lg";
                case "sm":
                    return "max-w-xl";
                case "md":
                    return "max-w-2xl";
                case "lg":
                    return "max-w-3xl";
                case "full":
                    return "max-w-full";
            }
        },
    },
    mounted() {
        const onEscape = (e) => {
            if (e.key === "Esc" || e.key === "Escape") {
                this.close();
            }
        };

        document.addEventListener("keydown", onEscape);

        this.$once("hook:beforeDestroy", () => {
            document.removeEventListener("keydown", onEscape);
        });
    },
};
</script>
