<template>
    <b-container class="create">
        <b-row>
            <b-col>

                <b-form 
                    class="create__form"
                    @submit="submit">

                    <h1 class="create__logo">
                        Hugelifts
                    </h1>

                    <b-form-group 
                        class="create__form-group"
                        label="Name">
                        <b-form-input 
                            class="create__form-control"
                            v-model="name"
                        >
                        </b-form-input>
                    </b-form-group>

                    <b-form-group 
                        class="create__form-group"
                        label="Email">
                        <b-form-input 
                            class="create__form-control"
                            v-model="email"
                        >
                        </b-form-input>
                    </b-form-group>

                    <b-form-group 
                        class="create__form-group"
                        label="Password">
                        <b-form-input 
                            class="create__form-control" 
                            type="password"
                            v-model="password"
                        >
                        </b-form-input>
                    </b-form-group>

                    <b-form-group 
                        class="create__form-group"
                        label="Confirm password">
                        <b-form-input 
                            class="create__form-control" 
                            type="password"
                            v-model="confirmPassword"
                        >
                        </b-form-input>
                    </b-form-group>

                    <progress-button 
                        class="create__button"
                        v-bind:class="{ disabled: !valid }"
                        :working="working"
                        buttonText="Create"
                        type="submit"
                    />

                    <b-alert
                        show
                        class="create__alert"
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

export default {

    components: {
        ProgressButton
    },

    data: function() {
        return {
            name: null,
            email: null,
            password: null,
            confirmPassword: null,
            errors: [],
            working: false
        }
    },

    methods: {

        submit: async function(e) {

            try {

                console.log("here")

                e.preventDefault()

                if (!this.valid) { return }

                this.working = true

                const data = {
                    name: this.name,
                    email: this.email,
                    password: this.password
                }

                await this.createUser(data)
                await this.createToken(data)

                this.working = false
                this.$router.push('/')

            } catch (e) {
                this.errors = formatErrors(e)
                this.working = false
            }

        },

        ...mapActions([
            'createUser',
            'createToken'
        ])

    },

    computed: {

        valid: function() {
            return (
                   this.password 
                && this.password.length >= 6
                && this.confirmPassword
                && this.confirmPassword === this.password
                && this.name
                && this.email
                && this.working === false
            )
        },

        icon: function() {
            return faSpinner
        }

    }

}

</script>

<style lang="scss" scoped>

.create {

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
