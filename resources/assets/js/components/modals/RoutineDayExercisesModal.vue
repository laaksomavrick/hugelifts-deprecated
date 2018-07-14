<template>
    <modal
        :open="open"
        :headerText="headerText"
        :onClose="onClose"
        :onSubmit="onSubmit"
        :working="working"
        :disabled="disabled"
    >
        <div class="exercises">
            <div class="exercises__items">
                <div 
                    v-for="exercise in exercises"
                    class="exercises__item"
                    :key="exercise.id">
                    <h5 class="exercises__text">
                        {{ exerciseName(exercise.exercise_id) }}
                    </h5>
                    <b-button class="exercises__btn" variant="danger" @click="handleDelete(exercise)">
                        <font-awesome-icon :icon="times" />
                    </b-button>
                </div>
            </div>
            <exercise-autocomplete :onSubmit="handleAdd" />
        </div>
    </modal>
</template>

<script>

import FontAwesomeIcon from '@fortawesome/vue-fontawesome'
import faTimes from '@fortawesome/fontawesome-free-solid/faTimes'

import Modal from './Modal'
import ExerciseAutocomplete from '../ExerciseAutocomplete'
import { mapGetters, mapActions } from 'vuex'

export default {

    components: {
        Modal,
        FontAwesomeIcon,
        ExerciseAutocomplete
    },

    data: function() {
        return {
            working: false,
            exercises: []
        }
    },

    watch: {

        day: function(val) {
            if (val && val.exercises) {
                this.exercises = val.exercises 
            }
        }

    },

    methods: {

        onClose: function() {
            return this.toggleRoutineDayExercisesModal({open: false, props: {}})
        },

        onSubmit: async function() {
            const day = {...this.day, exercises: this.exercises }
            await this.getRoutineDayExercisesModal.props.onSubmit(day)
            this.onClose()
        },

        handleDelete: function(exercise) {
            this.exercises = this.exercises.filter(e => e.id !== exercise.id)
        },

        handleAdd: function(added) {
            const exercise = {...added}
            exercise.exercise_id = exercise.id
            exercise.ordinal = this.exercises.length === 0 ? 0 : this.exercises.length
            exercise.routine_day_id = this.day.id
            exercise.sets = []
            delete exercise.id
            delete exercise.rep_max
            delete exercise.rep_max_interval
            delete exercise.name
            this.exercises = [...this.exercises, exercise]
        },

        exerciseName: function(id) {
            return this.getExercise(parseInt(id)).name
        },

        ...mapActions([
            'toggleRoutineDayExercisesModal',
        ])
    },

    computed: {

        open: function() {
            return this.getRoutineDayExercisesModal.open
        },
        
        headerText: function() {
            return this.getRoutineDayExercisesModal.props.headerText
        },

        day: function() {
            return this.getRoutineDayExercisesModal.props.day
        },

        times: function() {
            return faTimes
        },

        disabled: function() {
            return this.exercises.length === 0
        },

        ...mapGetters([
            'getRoutineDayExercisesModal',
            'getExercise'
        ])

    }



}

</script>


<style lang="scss" scoped>

.exercises {

    &__items {

    }

    &__item {
        display: flex;
        margin-bottom: .5rem;
    }

    &__btn {
        margin-left: auto;
    }

}
</style>
