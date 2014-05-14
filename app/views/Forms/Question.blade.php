<div class="question-container" data-question="" id="{{ $ID }}" data-type="{{ $Type }}" data-comment="">
    <div class="question-text">{{ $Pregunta }}</div>
    @if ($Type == "checkbox")
        <div class="question-check-container">
            <div class="question-check">
                <input type="checkbox" name="question-check" class="question-check-checkbox" id="{{ $CheckID }}">
                <label class="question-check-label" for="{{ $CheckID }}">
                    <div class="question-check-inner"></div>
                    <div class="question-check-switch"></div>
                </label>
            </div>
            <span class="icon-comment comment" data-question="{{ $ID }}"></span>
        </div>
    @elseif ($Type == "text")
        <div class="question-input-container center">
            <input type="text" class="form-control">
            <span class="icon-comment comment" data-question="{{ $ID }}"></span>
        </div>
    @else
        <div class="question-input-container center">
            <p>
                :(
            </p>
        </div>
    @endif
        
</div>