<template>
  
</template>

<script>
import {ToastProgrammatic} from "buefy"
export default {
    props: ['message', 'type'], 
    mounted() {
        ToastProgrammatic.open({
            message: this.message,
            type: this.type,
            position: 'is-bottom', 
            duration: 3500
        })
    },
}
</script>