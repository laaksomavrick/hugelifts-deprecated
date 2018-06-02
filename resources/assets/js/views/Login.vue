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
                <template v-if="working">
                    <font-awesome-icon :icon="icon" spin />
                </template>
                <template v-else>
                    Submit
                </template>
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

import FontAwesomeIcon from '@fortawesome/vue-fontawesome'
import faSpinner from '@fortawesome/fontawesome-free-solid/faSpinner'

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
