<template>
    <div class="create-lift">
        <div class="create-lift__form">
            <div class="create-lift__form-group">
                <label>Name</label>
                <input 
                    class="create-lift__form-control"
                    v-model="name"
                >
                </input>
            </div>
            <div class="create-lift__form-group">
                <label>Max Lift</label>
                <div class="create-lift__form-row">
                    <div class="col">
                        <input 
                            class="create-lift__form-control"
                            placeholder="Reps"
                            type="number"
                            min="0"
                            step="1"
                            v-model="repMaxInterval"
                        >
                        </input>
                    </div>
                    <div class="col">
                        <input 
                            class="create-lift__form-control"
                            placeholder="Weight"
                            type="number"
                            min="0"
                            step="1"
                            v-model="repMax"
                        >
                        </input>
                    </div>
                </div>
            </div>
            <button 
                class="create-lift__button"
                v-bind:class="{ disabled: !valid }"
                @click="submit"
            >
                <template v-if="working">
                    <font-awesome-icon :icon="icon" spin />
                </template>
                <template v-else>
                    Create
                </template>
            </button>
            <div
                class="create-lift__alert"
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
import { LIFTS_ROUTE } from '../constants'

export default {

    components: {
        FontAwesomeIcon
    },

    data: function() {
        return {
            name: null,
            repMaxInterval: null,
            repMax: null,
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
                    rep_max_interval: this.repMaxInterval,
                    rep_max: this.repMax
                }

                await this.createExercise(data)

                this.working = false
                this.$router.go(-1)

            } catch (e) {
                this.errors = formatErrors(e)
                this.working = false
            }

        },

        ...mapActions([
            'createExercise'
        ])

    },

    computed: {

        valid: function() {
            return (
                this.name
                && this.repMax
                && this.repMaxInterval
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

.create-lift {

    @extend .form;
    @include make-container();
    

    &__form {
        @extend .form__form;
        padding-top: 15px;
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

    &__form-row {
        @extend .form__form-row;
    }

    &__alert {
        @extend .form__alert;
    }
}

</style>
