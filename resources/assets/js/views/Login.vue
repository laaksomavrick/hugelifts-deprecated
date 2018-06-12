<template>
    <div class="login">
        <div class="login__form">
            <div class="login__logo">
                Hugelifts
            </div>
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
            <progress-button 
                class="login__button"
                v-bind:class="{ disabled: !valid }"
                :working="working"
                :handleClick="submit"
                buttonText="Login"
            />
            <div class="login__message">
                No account? Click <router-link :to="create">here</router-link> to register.
            </div>
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

@import '../../sass/bscore';
@import '../../sass/form';

.login {

    @include make-container();
    @extend .form;

    &__logo {
        font-size: 3rem;
        text-align: center;
        margin-bottom: 20px;
    }
    
    &__form {
        @extend .form__form;
    }

    &__form-group {
        @extend .form__form-group;
    }

    &__form-control {
        @extend .form__form-control;
    }

    &__button {
        @extend .form__button;
    }

    &__alert {
        @extend .form__alert;
    }
}

</style>
