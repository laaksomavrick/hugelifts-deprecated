<template>
    <b-container class="login">
        <b-row>
            <b-col>

                <b-form 
                    class="login__form" 
                    @submit="submit">

                    <h1 class="login__logo">
                        Hugelifts
                    </h1>

                    <b-form-group 
                        class="login__form-group"
                        label="Email address">
                        <b-form-input 
                            class="login__form-control"
                            v-model="email"
                        >
                        </b-form-input>
                    </b-form-group>

                    <b-form-group 
                        class="login__form-group"
                        label="Password">
                        <b-form-input 
                            class="login__form-control" 
                            type="password"
                            v-model="password"
                        >
                        </b-form-input>
                    </b-form-group>

                    <progress-button 
                        class="login__button"
                        v-bind:class="{ disabled: !valid }"
                        :working="working"
                        buttonText="Login"
                        type="submit"
                    />

                    <div class="login__message">
                        No account? Click <router-link :to="create">here</router-link> to register.
                    </div>
                    <b-alert
                        show
                        variant="danger"
                        v-for="(error, index) in errors"
                        v-bind:key="index"
                    >
                        {{ error }}
                    </b-alert>
                </b-form>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>

import ProgressButton from '../components/ProgressButton'
import { mapActions } from 'vuex'
import { formatErrors } from '../utils/error'
import { CREATE_ROUTE } from '../constants'

export default {

    components: {
        ProgressButton
    },

    data: function() {
        return {
            email: null,
            password: null,
            errors: [],
            working: false
        }
    },

    methods: {

        submit: async function(e) {

            try {

                e.preventDefault()

                if (!this.valid) { return }

                this.working = true

                const data = {
                    email: this.email,
                    password: this.password
                }

                await this.createToken(data)

                this.working = false
                this.$router.push('/')

            } catch (e) {
                this.errors = formatErrors(e)
                this.working = false
            }

        },

        ...mapActions([
            'createToken'
        ])

    },

    computed: {

        valid: function() {
            return (
                   this.password 
                && this.password.length >= 6
                && this.email
                && this.working === false
            )
        },

        icon: function() {
            return faSpinner
        },

        create: function() {
            return CREATE_ROUTE
        }

    }

}

</script>

<style lang="scss" scoped>

.login {

    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;

    &__logo {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    &__form {
        display: flex;
        flex-direction: column;
    }

    &__button {
        margin-bottom: 1rem;
    }

    &__message {
        margin-bottom: 1rem;
    }

}

</style>
