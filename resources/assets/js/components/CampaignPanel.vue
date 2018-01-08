<template>
    <div class="campaign-panel-container">
        <simple-panel
            class="campaign-panel"
        >
            <div class="row">
                <div class="col-xs-12 col-sm-2">
                    <img
                        :src="`//quicktransmit.com/api/campaigns/_cdn/InterCountyApplianceGroupRINT041/store_logos/${campaignObj.store_logo}`"
                    />
                    <p>
                        {{ campaignObj.store_name }}
                    </p>
                </div>
                <div class="col-xs-12 col-sm-10">
                    <table
                        class="table table-bordered table-condensed"
                    >
                        <thead>
                            <tr>
                                <th
                                    class="text-center"
                                    width="20%"
                                >
                                    Creative ID
                                </th>
                                <th
                                    class="text-center"
                                    width="20%"
                                >
                                    Default Phone
                                </th>
                                <th
                                    class="text-center"
                                    width="60%"
                                >
                                    Brands
                                    <span class="badge">
                                        {{ numberOfBrands(campaignObj.brands) }}
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p class="text-center bg-success">
                                        {{ campaignObj.creative_id }}
                                    </p>
                                </td>
                                <td>
                                    <p class="text-center bg-success">
                                        {{ campaignObj.store_default_phone }}
                                    </p>
                                </td>
                                <td>
                                    <span
                                        class="label label-success"
                                        style="margin-right: 4px;"
                                        v-for="brand in campaignObj.brands"
                                    >
                                        {{ brand.name }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </simple-panel>
    </div>
</template>

<script>

    import SimplePanel from './SimplePanel.vue'

    export default {
        props: {
            campaign: {
                type: String
            }
        },
        components: {
            SimplePanel
        },
        computed: {
            campaignObj() {
                return JSON.parse(this.campaign)
            }
        },
        methods: {
            numberOfBrands(obj) {
                return Object.keys(obj).length
            }
        }
    }
</script>