<template>
    <div class="login">
        <div class="login__form">
            <div class="login__form-group">
                <label>Email</label>
                <input 
                    class="login__form-control"
                    v-model="email"
                >
                </input>
            </div>
            <div class="login__form-group">
                <label>Password</label>
                <input 
                    class="login__form-control" 
                    type="password"
                    v-model="password"
                >
                </input>
            </div>
            <button 
                class="login__button"
                v-bind:class="{ disabled: !valid }"
                @click="submit"
            >
                {{ buttonMessage }}
            </button>
            <div
                class="login__alert"
                v-for="error in errors"
            >
                {{ error }}
            </div>
        </div>
    </div>
</template>

<script>

import { mapActions } from 'vuex'
import { formatErrors } from '../utils/error'

export default {

    data: function() {
        return {
            email: null,
            password: null,
            errors: [],
            working: false
        }
    },

    methods: {

        submit: async function() {

            try {

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
            'createToken',
            'getUser'
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

        buttonMessage: function() {
            return this.working ? 'Submitting' : 'Submit'
        }

    }

}

</script>

<style lang="scss" scoped>

@import '../../sass/bscore';
@import '../../sass/account';

.login {

    @include make-container();
    @extend .account;

    &__form {
        @extend .account__form;
    }

    &__form-group {
        @extend .account__form-group;
    }

    &__form-control {
        @extend .account__form-control;
    }

    &__button {
        @extend .account__button;
    }

    &__alert {
        @extend .account__alert;
    }
}

</style>
