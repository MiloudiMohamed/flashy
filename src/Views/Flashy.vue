<template>
    <transition :name="animation">
        <div v-if="show"
            class="flashy"
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
            dataTitle: {},
            dataMessage: {},
            dataDelay: {
                default: 3000
            },
            dataType: {
                default: 'success'
            },
            dataAnimated: {
                type: Boolean,
                default: true
            },
            dataTemplate: {
                default: 'bootstrap'
            }
        },
        data () {
            return {
                body: this.dataMessage,
                title: this.dataTitle,
                delay: this.dataDelay,
                type: this.dataType,
                animated: this.dataAnimated,
                show: false,
                template: this.dataTemplate
            }
        },
        computed: {
            alertType () {
                return this.getTamplate + this.type
            },
            animation () {
                return this.animated ? 'slide-fade' : ''
            },
            getTamplate () {
                return this.template === 'bootstrap' ? 'alert alert-' : 'notification is-'
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
