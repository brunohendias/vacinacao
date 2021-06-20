<template>
    <Layout>
        <h4>Historico</h4>
        <hr>
        <cadastro />
        <errors :errors="errors"/>
        <sucesso :success="success"/>
        <cabecalho :tot_registro="dados.length" />
        <listagem :dados="dados" />
    </Layout>
</template>

<script>
import Layout from '../Layout.vue'
import cadastro from '../components/cadastro/historico.vue'
import errors from '../components/shared/panel/errors.vue'
import sucesso from '../components/shared/panel/success.vue'
import cabecalho from '../components/shared/panel/listagem/cabecalho.vue'
import listagem from '../components/listagem/historico.vue'

export default {
    name: 'Historico',
    props: {
        dados: Array,
        errors: Object,
        success: String
    },
    components: {
        Layout,
        cadastro,
        errors,
        sucesso,
        cabecalho,
        listagem
    }
}
</script>