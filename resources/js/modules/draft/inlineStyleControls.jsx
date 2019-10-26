import PropTypes from 'prop-types';
import React from 'react';
import StyleButton from './styleButton.jsx';

const InlineStyleControls = (props) => {
  const INLINE_STYLES = [
      {
        label: 'Bold',
        style: 'BOLD'
      },
      {
        label: 'Italic',
        style: 'ITALIC'
      },
      {
        label: 'Underline',
        style: 'UNDERLINE'
      }
    ],
    currentStyle = props.editorState.getCurrentInlineStyle();

  return (
    <div className="RichEditor-controls">
      {INLINE_STYLES.map((type) =>
        <StyleButton
          key={type.label}
          active={currentStyle.has(type.style)}
          label={type.label}
          onToggle={props.onToggle}
          style={type.style}
        />
      )}
    </div>
  );
};

InlineStyleControls.propTypes = {
  editorState: PropTypes.object,
  onToggle: PropTypes.func
};

export default InlineStyleControls;