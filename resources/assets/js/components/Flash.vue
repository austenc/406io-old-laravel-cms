<template>
    <span class="hidden">
        <slot></slot>
    </span>
</template>
<script>
    export default {
        props: ['message'],
        mounted() {
            this.$snotify.info(this.$slots.default[0].text)
        }        
    }
</script>