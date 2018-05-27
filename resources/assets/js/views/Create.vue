<template>
    <div class="create">
        <div class="create__form">
            <div class="create__form-group">
                <label>Name</label>
                <input 
                    class="create__form-control"
                    v-model="name"
                >
                </input>
            </div>
            <div class="create__form-group">
                <label>Email</label>
                <input 
                    class="create__form-control"
                    v-model="email"
                >
                </input>
            </div>
            <div class="create__form-group">
                <label>Password</label>
                <input 
                    class="create__form-control" 
                    type="password"
                    v-model="password"
                >
                </input>
            </div>
            <div class="create__form-group">
                <label>Confirm password</label>
                <input 
                    class="create__form-control" 
                    type="password"
                    v-model="confirmPassword"
                >
                </input>
            </div>
            <button 
                class="create__button"
                v-bind:class="{ disabled: !valid }"
                @click="submit"
            >
                Submit
            </button>
            <div
                class="create__alert"
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

    //TODO: spinner on submit
    //TODO: redirect to home on finish
    //TODO: write feature test for refresh logic when expired

    data: function() {
        return {
            name: null,
            email: null,
            password: null,
            confirmPassword: null,
            errors: []
        }
    },

    methods: {

        submit: async function() {

            try {

                if (!this.valid) { return }

                const data = {
                    name: this.name,
                    email: this.email,
                    password: this.password
                }

                await this.createUser(data)
                await this.createToken(data)

            } catch (e) {
                this.errors = formatErrors(e)
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
            )
        }

    }

}

</script>

<style lang="scss" scoped>

@import '../../sass/account';

.create {

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
