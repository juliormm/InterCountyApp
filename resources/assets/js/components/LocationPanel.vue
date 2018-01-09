<template>
    <div class="location-panel-container">
        <simple-panel
            :headerText="`Location ${locationIdx}`"
            :key="idx"
            hasHeader
            panelType="success"
            v-for="(location, idx) in locationArr"
        >
            <div class="form-group">
                <label
                    for="address"
                >
                    Address
                </label>
                <input
                    :name="`locaction[${locationIdx}][address]`"
                    class="form-control"
                    id="address"
                    type="text"
                    v-model="location.address"
                />
            </div>
            <div class="form-group">
                <label
                    for="phoneNumber"
                >
                    Phone Number
                </label>
                <input
                    id="phoneNumber"
                    type="text"
                    class="form-control"
                    :name="`locaction[${locationIdx}][phone]`"
                    v-model="location.phone"
                />
            </div>
        </simple-panel>
    </div>
</template>

<script>
    import SimplePanel from './SimplePanel.vue'

    export default {
        props: {
            location: {
                type: String
            },
            locationIdx: {
                type: String
            }
        },
        components: {
            SimplePanel
        },
        computed: {
            locationArr() {
                return JSON.parse(this.location)
            }
        }
    }
</script>