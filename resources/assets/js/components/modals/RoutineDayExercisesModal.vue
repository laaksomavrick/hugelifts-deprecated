<template>
    <modal
        v-if="open"
        :headerText="headerText"
        :onClose="onClose"
        :onSubmit="onSubmit"
        :working="working"
    >
        <div class="exercises">
            <div 
                v-for="exercise in exercises"
                class="exercises__item"
             >
                <div class="exercises__text">
                    {{ exerciseName(exercise.id) }}
                </div>
                <button class="exercises__delete" @click="handleDelete(exercise)">
                    <font-awesome-icon :icon="times" />
                </button>
            </div>
        </div>
    </modal>
</template>

<script>

import FontAwesomeIcon from '@fortawesome/vue-fontawesome'
import faTimes from '@fortawesome/fontawesome-free-solid/faTimes'

import Modal from './Modal'
import { mapGetters, mapActions } from 'vuex'

export default {

    //list of exercises with X
    //ADD NEW btn ~> autocomplete? dropdown?

    components: {
        Modal,
        FontAwesomeIcon
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

        exerciseName: function(id) {
            return this.getExercise(id).name
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
    }

}

</style>
