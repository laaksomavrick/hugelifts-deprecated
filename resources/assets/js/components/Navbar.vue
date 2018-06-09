<template>
    <nav class="navbar">
        <div class="navbar__brand">
            <font-awesome-icon 
                class="navbar__brand-icon" 
                :icon="brandIcon" 
            />
        </div>
        <div class="navbar__routes">
            <template v-for="route in routes">
                <div class="navbar__item" v-bind:class="{ 'navbar__item--active': isActive(route.route) }">
                    <router-link :to="{ name: route.route}" class="navbar__link">{{ route.text }}</router-link>
                </div>
            </template>
        </div>
        <div class="navbar__actions">
            <div class="navbar__action">
                <font-awesome-icon 
                    class="navbar__plus-icon" 
                    :icon="plusIcon" 
                    v-if="addIsVisible"
                    @click="handleAddClick" 
                />
            </div>
        </div>
    </nav>
</template>

<script>

import FontAwesomeIcon from '@fortawesome/vue-fontawesome'
import faPlusSquare from '@fortawesome/fontawesome-free-solid/faPlusSquare'
import faDumbbell from '@fortawesome/fontawesome-free-solid/faDumbbell'
import { HOME_ROUTE, ACTIVE_ROUTE, ROUTINES_ROUTE, LIFTS_ROUTE, NEW_LIFT_ROUTE, EDIT_LIFT_ROUTE, NEW_ROUTINE_ROUTE } from '../constants'

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
            return this.$route.path.includes(name)
        },

        handleAddClick: function() {
            switch(this.$route.name) {
                case LIFTS_ROUTE:
                    this.$router.push(NEW_LIFT_ROUTE)
                break
                case ROUTINES_ROUTE:
                    this.$router.push(NEW_ROUTINE_ROUTE)
                break
                default: break
            }
        }

    },

    computed : {

        addIsVisible: function() {
            const path = this.$route.path
            return (
                   path === ROUTINES_ROUTE
                || path === LIFTS_ROUTE
            )
        },

        plusIcon: function() {
            return faPlusSquare
        },

        brandIcon: function() {
            return faDumbbell
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
    box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.2),
                0 4px 5px 0 rgba(0, 0, 0, 0.14),
                0 1px 10px 0 rgba(0, 0, 0, 0.12);

    &__brand {
        @extend .navbar-brand;
    }

    &__routes {
        display: flex;
    }

    &__actions {
        margin-left: auto;
    }

    &__action {
        width: 40px;
        height: 40px;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 20px;

        &:active {
            background: lighten($primary, 10%);
        }
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

    &__plus-icon {
        font-size: 17px;
    }

    &__brand-icon {
        
    }

}

</style>
