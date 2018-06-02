<template>
    <nav class="navbar">
        <div class="navbar__brand">
            Brand
        </div>
        <div class="navbar__routes">
            <template v-for="route in routes">
                <div class="navbar__item" v-bind:class="{ 'navbar__item--active': isActive(route.route) }">
                    <router-link :to="{ name: route.route}" class="navbar__link">{{ route.text }}</router-link>
                </div>
            </template>
        </div>
        <div class="navbar__actions">
            <font-awesome-icon 
                class="navbar__icon" 
                :icon="icon" 
                v-if="addVisible"
                @click="handleAddClick" 
            />
        </div>
    </nav>
</template>

<script>

import FontAwesomeIcon from '@fortawesome/vue-fontawesome'
import faPlusSquare from '@fortawesome/fontawesome-free-solid/faPlusSquare'
import { ACTIVE_ROUTE, ROUTINES_ROUTE, LIFTS_ROUTE } from '../constants'

export default {

    name: 'NavBar',

    components: {
        FontAwesomeIcon
    },

    data: function() {
        return {
            routes: [
                {route: ACTIVE_ROUTE, text: 'Schedule'},
                {route: ROUTINES_ROUTE, text: 'Routines'},
                {route: LIFTS_ROUTE, text: 'Lifts'}
            ]
        }
    },

    methods: {

        isActive: function(name) {
            return this.$route.name === name
        },

        handleAddClick: function() {
            console.log("hello world")
        }

    },

    computed : {

        addVisible: function() {
            //TODO
            return true
        },

        icon: function() {
            return faPlusSquare
        }

    }

}

</script>

<style lang="scss" scoped>

@import '../../sass/bscore';
@import '~bootstrap/scss/navbar';
@import '~bootstrap/scss/nav';
@import '~bootstrap/scss/root';
@import '~bootstrap/scss/utilities/background';

.navbar {
    @extend .navbar;
    @extend .navbar-dark;
    @extend .bg-primary;

    color: white;
    justify-content: left;

    &__brand {
        @extend .navbar-brand;
    }

    &__routes {
        display: flex;
    }

    &__actions {
        margin-left: auto;
    }

    &__item {

        @extend .nav-item;
        opacity: 0.7;
        margin-left: 5px;
        margin-right: 5px;

        &--active {
            @extend .active;
            opacity: 1.0;
        }

    }

    &__link {
        color: white;
        text-decoration: none;
    }

    &__icon {
        font-size: 17px;
        cursor: pointer;
    }

}

</style>
