<template>
    <div>
        <span class="bg-blue rounded p-1 mr-1" v-for="tag in tags">
            {{ tag }}
        </span>
        <input type="text" v-model="tag" placeholder="Enter Tag" class="bg-white p-1 rounded ml-3" @keydown.13.prevent="addTag">
        <input type="hidden" name="tags" v-model="commaTags">
    </div>
</template>

<script>
    export default {
        props: {
            for: {
                default: null
            }
        },
        data() {
            return {
                tag: '',
                tags: []             
            }
        },

        computed: {
            commaTags() {
                return this.tags.join(',')
            }
        },

        methods: {
            addTag() {
                this.tag.split(',').forEach((tag) => { this.tags.push(tag) })
                this.tag = ''
            }
        },

        mounted() {
            this.tags = this.for;
        }
    }    
</script>