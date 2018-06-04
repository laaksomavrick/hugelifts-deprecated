<template>
    <div class="routines">
        <div class="routines__subheader">
            Active
        </div>
        <div
            class="routines__item"
            @click=""
        >
            {{ getActiveRoutine.name }}
        </div>
        <div class="routines__subheader">
            Inactive
        </div>
        <div
            v-for="routine in getInactiveRoutines"
            class="routines__item"
            @click=""
        >
            {{ routine.name }}
        </div>
    </div>
</template>

<script>

import { mapActions, mapGetters } from 'vuex'

export default {

    computed: {

        getActiveRoutine: function() {
            return this.getRoutines.find(r => !!r.active === true)
        },

        getInactiveRoutines: function() {
            return this.getRoutines.filter(r => !!r.active !== true)
        },

        ...mapGetters([
            'getRoutines'
        ])

    }

}

</script>

<style lang="scss" scoped>

@import '../../sass/bscore';
@import '~bootstrap/scss/list-group';
@import '~bootstrap/scss/badge';

.routines {

    @extend .list-group;

    &__item {
        @extend .list-group-item;
        @extend .list-group-item-action;
        border-radius: 0px!important;
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    &__subheader {
        padding: 5px 0px 5px 20px;
        opacity: 0.7;
    }

}

</style>
