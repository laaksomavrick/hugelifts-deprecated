<template>
    <modal
        v-if="open"
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
                 >
                    <div class="exercises__text">
                        {{ exerciseName(exercise.exercise_id) }}
                    </div>
                    <button class="exercises__delete" @click="handleDelete(exercise)">
                        <font-awesome-icon :icon="times" />
                    </button>
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

@import '../../../sass/bscore';
@import '~bootstrap/scss/buttons';

.exercises {

    &__items {
        & > * {
            margin-top: 10px;
            margin-bottom: 10px;
        }
        & > *:first-child {
            margin-top: 0px;
            margin-bottom: 10px;
        }
        & > *:last-child {
            margin-top: 10px;
            margin-bottom: 0px;
        }
    }

    &__item {
        display: flex;
        align-items: center;
    }

    &__text {
        flex: 1;
        font-size: 16px;
    }

    &__delete {
        @extend .btn;
        @extend .btn-danger;
        margin-left: auto;
        height: 25px;
        width: 25px;
        padding: 0;
        margin: 0;
    }

}

</style>
