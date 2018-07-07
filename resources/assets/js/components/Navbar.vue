<template>
    <b-navbar 
        toggleable
        type="dark"
        variant="primary">

        <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

        <b-navbar-brand class="navbar__brand">
            <font-awesome-icon 
                class="navbar__brand-icon" 
                :icon="brandIcon" 
            />
        </b-navbar-brand>

        <b-collapse is-nav id="nav_collapse">
            <b-navbar-nav>
                <template v-for="(route, index) in routes">
                    <b-nav-item 
                        class="navbar__item" 
                        v-bind:key="index"
                        v-bind:class="{ 'navbar__item--active': isActive(route.route) }"
                        :to="{ name: route.route}">
                        {{ route.text }}
                    </b-nav-item>
                </template>
            </b-navbar-nav>

            <b-navbar-nav class="ml-auto">
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
            </b-navbar-nav>

        </b-collapse>
    </b-navbar>
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

.navbar {

    color: white;
    margin-bottom: 1rem;
    box-shadow: 
        0 3px 1px -2px rgba(0,0,0,.2), 
        0 2px 2px 0 rgba(0,0,0,.14), 
        0 1px 5px 0 rgba(0,0,0,.12);

    &__item {
        color: white;
    }

}

</style>
