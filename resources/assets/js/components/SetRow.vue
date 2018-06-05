<template>
    <div class="set-row">
        <div class="set-row__text">
            {{ text }}
        </div>
        <div class="set-row__actions">
            <input
                class="set-row__form-control"
                placeholder="Reps"
                type="number"
                min="1"
                max="12"
                step="1"
                v-model="reps"
                @change="handleChange"
            >
            </input>
            <input
                class="set-row__form-control"
                placeholder="%"
                type="number"
                min="0"
                max="100"
                step="5"
                v-model="percentage"
                @change="handleChange"
            >
            </input>
        </div>
    </div>
</template>

<script>

import { mapGetters } from 'vuex'

export default {

    props: {
        set: Object,
        ordinal: Number,
        onChange: Function
    },

    data: function() {
        return {
            reps: this.set.reps,
            percentage: this.set.percentage
        }
    },

    methods: {
        
        handleChange: function(e) {
            const reps = parseInt(this.reps)
            const percentage = parseInt(this.percentage)
            const routine_day_exercise_id = this.set.routine_day_exercise_id
            const id = this.set.id
            const set = { id, routine_day_exercise_id, reps, percentage }
            this.onChange(set)
        }

    },

    computed: {

        text: function() {
            const ordinal = this.ordinal + 1
            return `Set ${ordinal}.`
        }

    }

}

</script>

<style lang="scss" scoped>

@import '../../sass/bscore';
@import '../../sass/form';

.set-row {
    display: flex;
    align-items: center;

    &__text {

    }

    &__actions {
        margin-left: auto;
        display: flex;
    }

    &__form-control {
        @extend .form-control;
        padding: 2.5px;
        max-width: 80px;
        min-width: 50px;
        margin-left: 5px;
        margin-right: 5px;
        text-align: center;
    }
}

</style>
