<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ml-3" v-for="(link, i) in links" :key="i">
                        <inertia-link class="nav-link" :class="linkAtual == link.link ? 'active' : ''" :href="link.link"
                            @click="load = true">
                            {{ link.label }}
                        </inertia-link>
                    </li>
                </ul>
            </div>
        </nav>
        <div v-if="load" class="mt-4 p-4 d-flex justify-content-center">
            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div v-else class="container mt-4 p-4 bg-white rounded">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Layout',
    data() {
        return {
            links: [
                { label: 'Fabricante', link: '/fabricante'},
                { label: 'Vacina', link: '/vacina'},
                { label: 'Paciente', link: '/paciente'},
                { label: 'Historico', link: '/historico'}
            ],
            load: false
        }
    },
    computed: {
        linkAtual() {
            return window.location.pathname
        }
    }
}
</script>