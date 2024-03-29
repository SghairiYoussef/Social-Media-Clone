<template>
    <Chart :data="data" :margin="margin" :direction="direction" :axis="axis">
            <template #layers>
                <Grid strokeDasharray="2,2" />
                <Bar :dataKeys="['name', 'pl']" :barStyle="{ fill: '#90e0ef' }" />
                <Bar :dataKeys="['name', 'avg']" :barStyle="{ fill: '#0096c7' }" />
                <Bar :dataKeys="['name', 'inc']" :barStyle="{ fill: '#48cae4' }" />
                <Marker :value="1000" label="Avg." color="#e76f51" strokeWidth="2" strokeDasharray="6 6" />
            </template>
            <template #widgets>
                <Tooltip
                    borderColor="#48CAE4"
                    :config="{
                        pl: { color: '#90e0ef' },
                        avg: { color: '#0096c7' },
                        inc: { color: '#48cae4' }
                    }"
                />
            </template>
    </Chart>

</template>

<script>
    import { Chart, Bar, Grid, Marker, Tooltip } from 'vue3-charts';
    import { defineComponent, ref } from 'vue';
    import plByMonth from './data';
    export default defineComponent( {
        name: 'LineChart',
        components: { Chart, Bar, Grid, Marker, Tooltip },
        setup() {
            const data = ref(plByMonth)
            const direction = ref('horizontal')
            const margin = ref({
            left: 0,
            top: 20,
            right: 20,
            bottom: 0
            })

            return { data, direction, margin }
        }
    })
</script>