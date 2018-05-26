<template>
    <div class="create">
        <div class="create__form">
            <div class="create__form-group">
                <label>Username</label>
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
        </div>
    </div>
</template>

<script>

import { mapActions } from 'vuex'

export default {

    //TODO: spinner on submit
    //TODO: redirect to home on finish

    data: function() {
        return {
            name: null,
            email: null,
            password: null,
            confirmPassword: null
        }
    },

    mounted: function() {

    },

    methods: {

        submit: function() {

            if (!this.valid) { return }

            const data = {
                name: this.name,
                email: this.email,
                password: this.password
            }

            this.createUser(data)

        },

        ...mapActions([
            'createUser'
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
}

</style>
