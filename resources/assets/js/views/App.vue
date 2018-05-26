<template>
    <div>
        <p>
            <router-link :to="{ name: 'home' }">Home</router-link>
            <router-link :to="{ name: 'login' }">Login</router-link>
            <router-link :to="{ name: 'create' }">Create</router-link>
        </p>
        <div class="app">
            <router-view></router-view>
        </div>
    </div>
</template>

<style lang="scss" scoped>

.app {

}

</style>
