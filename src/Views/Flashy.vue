<template>
    <transition :name="animation">
        <div v-if="show"
            class="flashy alert"
            :class="alertType"
            role="alert"
        >
        <strong v-if="title">{{ title }} </strong>
          {{ body }}
        </div>
    </transition>
</template>

<script>
    export default {
        props: {
            dataTitle: {
                default: ''
            },
            dataMessage: {
                default: ''
            },
            dataDelay: {
                default: 3000
            },
            dataType: {
                default: 'success'
            },
            dataAnimated: {
                type: Boolean,
                default: true
            }
        },
        data () {
            return {
                body: this.dataMessage,
                title: this.dataTitle,
                delay: this.dataDelay,
                type: 'success',
                animated: this.dataAnimated,
                show: false
            }
        },
        computed: {
            alertType () {
                return 'alert-' + this.type
            },
            animation () {
                return this.animated ? 'slide-fade' : ''
            }
        },

        created() {
            if (this.body) {
                this.flash(this.body, this.title, this.type)
            }
            window.events.$on('flashy', (message, title, type) => this.flash(message, title, type))
        },

        methods: {
            flash(message, title = '', type = 'success') {
                this.body = message
                this.title = title
                this.type = type
                this.show = true
                this.hide()
            },

            hide () {
                setTimeout(() => {
                    this.show = false
                }, this.delay)
            }
        }

    }
</script>

<style scoped>
    .flashy {
        position: fixed;
        bottom: 1em;
        right: 2em;
    }

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
