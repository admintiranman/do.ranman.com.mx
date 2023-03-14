<template>
    <tr>
        <td>
            1
        </td>
        <td>
            {{subsummary.text}}
        </td>
    </tr>
</template>

<script>
export default {
    props: ['questions', 'options', 'subsummary'],
    mounted() {
        console.log(this.questions, this.options, this.subsummary);
    }

    
    
}
</script>

<style>

</style>