<template>
    <Layout>
        <h4>Historico</h4>
        <hr>
        <cadastro />
        <errors :errors="errors"/>
        <cabecalho :tot_registro="dados.length" />
        <listagem :dados="dados" />
    </Layout>
</template>

<script>
import Layout from '../Layout.vue'
import cadastro from '../components/cadastro/historico.vue'
import errors from '../components/shared/panel/error/cadastro.vue'
import cabecalho from '../components/shared/panel/listagem/cabecalho.vue'
import listagem from '../components/listagem/historico.vue'

export default {
    name: 'Historico',
    props: {
        dados: Array,
        errors: Object
    },
    components: {
        Layout,
        cadastro,
        errors,
        cabecalho,
        listagem
    }
}
</script>