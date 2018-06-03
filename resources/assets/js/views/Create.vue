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
            <progress-button 
                class="create__button"
                v-bind:class="{ disabled: !valid }"
                :working="working"
                :handleClick="submit"
                buttonText="Create"
            />
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

        submit: async function() {

            try {

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

@import '../../sass/bscore';
@import '../../sass/form';

.create {

    @extend .form;
    @include make-container();

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
