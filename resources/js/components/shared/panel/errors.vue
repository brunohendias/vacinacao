<template>
    <ul class="mt-2">
        <li v-for="(erro, i) in errors" :key="i">
            {{ erro }}
        </li>
    </ul>
</template>

<script>
export default {
    name: 'errorsCadastro',
    props: {
        errors: Object
    }
}
</script>

<style scoped>
    li {
        color: red;
    }
</style>