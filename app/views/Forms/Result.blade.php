<div class="question-container" id="{{ $ID }}" data-type="{{ $Type }}" data-comment="{{ $Comentario }}">
    <div class="question-text">{{ $Pregunta }}</div>
    @if ($Type == "checkbox")
        <div class="question-check-container">
            <div class="question-check">
                <input type="checkbox" name="question-check" class="question-check-checkbox" id="{{ $CheckID }}" {{ $Value }} disabled>
                <label class="question-check-label" for="{{ $CheckID }}">
                    <div class="question-check-inner"></div>
                    <div class="question-check-switch"></div>
                </label>
            </div>
            <span class="icon-comment comment {{ $HasComment }}" data-question="{{ $ID }}"></span>
        </div>
    @elseif ($Type == "text")
        <div class="question-input-container center">
            <input type="text" class="form-control" disabled value="{{ $Value }}">
            <span class="icon-comment comment {{ $HasComment }}" data-question="{{ $ID }}"></span>
        </div>
    @else
        <div class="question-input-container center">
            <p>
                :(
            </p>
        </div>
    @endif        
</div>