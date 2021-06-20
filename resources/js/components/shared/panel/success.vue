<template>
    <div v-if="success" class="alert alert-success mt-2 col-sm-5">{{ success }}</div>
</template>

<script>
export default {
    name: 'alertSuccess',
    props: {
        success: String
    }
}
</script>