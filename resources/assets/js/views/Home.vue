<template>
    <div>
      <p>homepage</p>
    </div>
</template>

<script>

import { getHelloWorld } from '../api/api'


export default {


    mounted: async function() {

        const response = await getHelloWorld()
        console.log(response.data)

    }

}

</script>
