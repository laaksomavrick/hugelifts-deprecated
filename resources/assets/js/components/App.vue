<template>
    <div class="app">
        <router-link :to="{ name: 'home' }">Home</router-link>
        <router-link :to="{ name: 'login' }">Login</router-link>
        <router-link :to="{ name: 'create' }">Create</router-link>
        <router-view></router-view>
    </div>
</template>

<style lang="scss" scoped>

@import '~bootstrap/scss/bootstrap';

.app {

    @include make-container();
    height: 100vh;

}

</style>
