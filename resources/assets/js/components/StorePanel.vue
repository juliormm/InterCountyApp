<template>
    <div class="store-panel-container">
        <simple-panel>
            <div class="row flex-row">
                <div class="col-xs-12 col-sm-3">
                    <a :href="`/stores/${storeIdx}/edit`">
                        <img
                            :src="`http://quicktransmit.com/api/campaigns/_cdn/InterCountyApplianceGroupRINT041/store_logos/${storeObj.logo}`"
                        />
                    </a>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <a :href="`/stores/${storeIdx}/edit`">
                        <h3 class="store-name">
                            {{ storeObj.name }}
                        </h3>
                    </a>
                    <a
                        class="telephone-number"
                        :tel="storeObj.default_phone">
                        {{ storeObj.default_phone }}
                    </a>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <button
                        @click="toggleLocations"
                        class="btn btn-default close-locations"
                        v-show="showLocations"
                    >
                        <span class="glyphicon glyphicon-minus"></span> Close Locations
                    </button>
                    <button
                        @click="toggleLocations"
                        class="btn btn-default show-locations"
                        v-show="!showLocations"
                    >
                        <span class="glyphicon glyphicon-plus"></span> Show Locations
                    </button>
                    <simple-panel
                        :class="dynamicPadding(idx)"
                        :headerText="`Location ${idx + 1}`"
                        :key="idx"
                        hasHeader
                        panelType="info"
                        v-for="(item, idx) in locationArr"
                        v-show="showLocations"
                    >
                        <ul class="sub-list">
                            <li>
                                {{ item.address }}
                            </li>
                            <li>
                                {{ item.phone }}
                            </li>
                        </ul>
                    </simple-panel>
                </div>
                <div class="col-xs-12 col-sm-2 text-center">
                    <a
                        :href="`/stores/${storeIdx}/edit`"
                        class="btn btn-success store-edit-button"
                        role="button"
                    >
                        Edit
                    </a>
                </div>
            </div>
        </simple-panel>
    </div>
</template>

<script>

import SimplePanel from './SimplePanel.vue'

export default {
    props: {
        store: {
            type: String
        },
        storeIdx: {
            type: String
        },
        location: {
            type: String
        },
        editLink: {
            type: String
        }
    },
    data() {
        return {
            showLocations: false
        }
    },
    methods: {
        dynamicPadding(index) {
            if (this.locationArr.length === 1 ||
                index === this.locationArr.length -1) {
                return 'mb-0'
            }

            return null
        },
        toggleLocations() {
            this.showLocations = !this.showLocations
        }
    },
    computed: {
        storeObj() {
            return JSON.parse(this.store)
        },
        locationArr() {
            return JSON.parse(this.location)
        }
    },
    components: {
        SimplePanel
    }
}

</script>

<style lang="scss"></style>