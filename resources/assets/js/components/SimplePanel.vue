<template>
    <div
        class="panel"
        :class="`panel-${panelType} simple-panel`"
    >
        <div
            class="panel-heading"
            v-if="hasHeader"
        >
            <h3 class="panel-title">
                {{ headerText }}
            </h3>
        </div>
        <div class="panel-body">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            panelType: {
                type: String,
                default: 'default'
            },
            hasHeader: {
                type: Boolean,
                default: false
            },
            headerText: {
                type: String,
                default: 'More Info'
            }
        }
    }
</script>