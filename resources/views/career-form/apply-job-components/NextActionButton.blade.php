<span x-on:click="
                $wire.dispatchFormEvent(
                    'wizard::nextStep',
                    'data',
                    getStepIndex(step),
                )
            " x-show="! isLastStep()">
<div class="cglzl c0spu c7764">
    <button class="ch5p0 comj7 c3fma cfkyn cv0zi cq3a6 csg05" type="button">
        Next
    </button>
</div>
</span>


