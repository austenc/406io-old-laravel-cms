<template>
    <button type="button" 
        :name="buttonName"
        @click.prevent="togglePublish"
        class="ml-4 py-1 pt-2 px-2 bg-purple hover:bg-purple-dark rounded text-white">
            <span v-if="isPublished">Unpublish</span>
            <span v-else>Publish</span>
    </button>
</template>

<script>
    export default {
        props: ['page', 'published'],

        data() {
            return {
                isPublished: false
            }
        },

        computed: {
            successText() {
                return this.isPublished ? 'published' : 'unpublished';
            },
            buttonName() {
                return this.isPublished ? 'unpublish' : 'publish';
            },
            url() {
                if (this.isPublished) {
                    return '/pages/' + this.page + '/unpublish';
                }

                return '/pages/' + this.page + '/publish';
            }
        },

        methods:  {
            togglePublish() {
                axios.post(this.url).then((response) => {
                    this.isPublished = !this.isPublished;
                    this.$snotify.success('Page ' + this.successText)
                });
            }    
        },

        created() {
            this.isPublished = this.published
        }
    }
</script>
