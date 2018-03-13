<template>
    <div>
        <span class="text-sm bg-blue rounded p-1 mr-1" v-for="tag in tags">
            {{ tag }}
            <button @click.prevent="removeTag(tag)" class="text-white">&times;</button>
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
                if (this.tag.trim().length > 0) {
                    this.tag.split(',').forEach((tag) => { this.tags.push(tag) })
                    this.tag = ''                    
                }
            },
            removeTag(tag) {
                this.tags = _.without(this.tags, tag)                
            }
        },

        mounted() {
            this.tags = this.for
        }
    }    
</script>