<template>
    <transition :name="animation">
        <div v-if="show"
            class="fixed pin-b pin-r mr-8 mb-6 py-3 px-4 rounded-md shadow text-white"
            :class="[types[dataType]]"
        >
            <strong>{{ dataTitle }}</strong> {{ dataMessage }}
        </div>
    </transition>
</template>

<script>
    export default {
        props: {
            type: {
                require: false,
                type: String,
                default: 'success'
            },

            title: {
                type: String
            },

            message: {
                type: String
            },

            delay: { default: 3000 },

            animated: {
                type: Boolean,
                default: true
            },
        },
        data () {
            return {
                show: false,
                dataTitle: this.title,
                dataMessage: this.message,
                dataType: this.type,

                types: {
                    primary: 'bg-blue',
                    success: 'bg-green',
                    danger: 'bg-red',
                    warning: 'bg-orange',
                    secondary: 'bg-grey-darker',
                    black: 'bg-black',
                    light: 'bg-white text-black border',
                },
            }
        },

        computed: {
            animation () {
                return this.animated ? 'slide-fade' : ''
            }
        },

        mounted() {
            if (this.dataMessage) {
                this.flash(this.dataMessage, this.dataType, this.dataTitle)
            }
            window.events.$on('flashy', (message, type, title) => this.flash(message, type, title))
        },

        methods: {
            flash(message, type='success', title) {
                this.dataMessage = message
                this.dataType = type
                this.dataTitle = title
                this.show = true
                this.hide()
            },

            hide () {
                setTimeout(() => {
                    this.show = false
                    this.clearFlash()
                }, this.delay)
            },

            clearFlash () {
                this.dataMessage = null
                this.dataTitle = null
                this.dataType = null
            }
        }

    }
</script>

<style scoped>
    .slide-fade-enter-active {
      transition: all .3s ease;
    }
    .slide-fade-leave-active {
      transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to {
      transform: translateX(100px);
      opacity: 0;
    }
</style>
