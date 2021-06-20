<template>
    <button type="submit" class="btn btn-success h-100" :disabled="disable || load" @click.prevent="submit">
        <span v-if="load" class="spinner-border" style="width: 1rem; height: 1rem;"></span>
        <span v-else> Cadastrar </span>
    </button>
</template>

<script>
import { Inertia } from '@inertiajs/inertia'

export default {
    name: 'cadastro',
    props: {
        body: Object,
        disable: Boolean,
        web: String
    },
    data() {
        return {
            load: false
        }
    },
    created() {
        Inertia.on('start', () => this.load = true)
        Inertia.on('finish', () => this.load = false)
    },
    methods: {
        async submit() {
            if (this.disable) return false;

            await this.$inertia.post(this.web, this.body);
        }
    }
}
</script>

<style scoped>
    button {
        margin-top: 31px;
    }
</style>