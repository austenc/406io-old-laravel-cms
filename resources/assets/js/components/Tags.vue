<template>
    <div>
        <span class="text-sm bg-blue rounded p-1 mr-1" v-for="tag in tags">
            {{ tag }}
            <button @click.prevent="removeTag(tag)" class="text-white">&times;</button>
        </span>
        <input type="text" v-model="tag" placeholder="Enter Tag" class="bg-white p-1 rounded ml-3 animated fadeInDown" @keydown.13.prevent="addTag" v-show="showInput" ref="input">
        <input type="hidden" name="tags" v-model="commaTags">
        <button class="rounded-full p-2 text-grey hover:text-white"
            @click.prevent="toggleInput">
            <font-awesome-icon icon="tags" v-show="!showInput" />
            <font-awesome-icon icon="times" v-show="showInput" />
        </button>
    </div>
</template>

<script>
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome'
    export default {
        components: {
            FontAwesomeIcon
        },
        props: {
            list: {
                type: Array,
                default: () => []
            }
        },
        data() {
            return {
                tag: '',
                tags: this.list,
                showInput: false             
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
            },
            toggleInput() {
                this.showInput = !this.showInput;

                if (this.showInput === true) {
                    this.$refs.input.focus();
                }
            }
        }
    }    
</script>

<style scoped>
    .animated {
      -webkit-animation-duration: 500ms;
      animation-duration: 500ms;
      -webkit-animation-fill-mode: both;
      animation-fill-mode: both;
    }

    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translate3d(0, -100%, 0);
      }

      to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
      }
    }

    .fadeInDown {
      animation-name: fadeInDown;
    }
</style>