import PropTypes from 'prop-types';
import React from 'react';
import StyleButton from './styleButton.jsx';

const BlockStyleControls = (props) => {
  const BLOCK_TYPES = [
      {
        label: 'H3',
        style: 'header-three'
      },
      {
        label: 'H4',
        style: 'header-four'
      },
      {
        label: 'H5',
        style: 'header-five'
      },
      {
        label: 'H6',
        style: 'header-six'
      },
      {
        label: 'Blockquote',
        style: 'blockquote'
      },
      {
        label: 'UL',
        style: 'unordered-list-item'
      },
      {
        label: 'OL',
        style: 'ordered-list-item'
      }
    ],
    { editorState } = props,
    selection = editorState.getSelection(),
    // eslint-disable-next-line sort-vars
    blockType = editorState
      .getCurrentContent()
      .getBlockForKey(selection.getStartKey())
      .getType();

  return (
    <div className="RichEditor-controls">
      {BLOCK_TYPES.map((type) =>
        <StyleButton
          key={type.label}
          active={type.style === blockType}
          label={type.label}
          onToggle={props.onToggle}
          style={type.style}
        />
      )}
    </div>
  );
};

BlockStyleControls.propTypes = {
  editorState: PropTypes.object,
  onToggle: PropTypes.func
};

export default BlockStyleControls;