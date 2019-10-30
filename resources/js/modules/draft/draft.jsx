import BlockStyleControls from './blockStyleControls.jsx';
import InlineStyleControls from './inlineStyleControls.jsx';
import React from 'react';
import ReactDOM from 'react-dom';
import { convertFromRaw, convertToRaw, Editor, EditorState, getDefaultKeyBinding, RichUtils } from 'draft-js';

class RichEditor extends React.Component {

  constructor(props) {
    super(props);
    this.state = { editorState: EditorState.createEmpty() };

    this.focus = () => this.editor.focus();
    this.onChange = (editorState) => this.setState({ editorState });

    /* eslint-disable no-underscore-dangle */
    this.handleKeyCommand = this._handleKeyCommand.bind(this);
    this.mapKeyToEditorCommand = this._mapKeyToEditorCommand.bind(this);
    this.toggleBlockType = this._toggleBlockType.bind(this);
    this.toggleInlineStyle = this._toggleInlineStyle.bind(this);
    /* eslint-enable no-underscore-dangle */
    this.element = null;
    this.styleMap = {
      CODE: {
        backgroundColor: 'rgba(0, 0, 0, 0.05)',
        fontFamily: '"Inconsolata", "Menlo", "Consolas", monospace',
        fontSize: 16,
        padding: 2
      }
    };
  }

  static getBlockStyle(block) {
    switch (block.getType()) {
      case 'blockquote': return 'RichEditor-blockquote';
      default: return null;
    }
  }

  _handleKeyCommand(command, editorState) {
    const newState = RichUtils.handleKeyCommand(editorState, command);

    if (newState) {
      this.onChange(newState);
      return true;
    }
    return false;
  }

  _mapKeyToEditorCommand(e) {
    if (e.keyCode === 9 /* TAB */) {

      const newEditorState = RichUtils.onTab(
        e,
        this.state.editorState,
        4, /* maxDepth */
      );

      if (newEditorState !== this.state.editorState) {
        this.onChange(newEditorState);
      }
      return false;
    }

    return getDefaultKeyBinding(e);
  }

  _toggleBlockType(blockType) {
    this.onChange(
      RichUtils.toggleBlockType(
        this.state.editorState,
        blockType
      )
    );
  }

  _toggleInlineStyle(inlineStyle) {
    this.onChange(
      RichUtils.toggleInlineStyle(
        this.state.editorState,
        inlineStyle
      )
    );
  }

  componentDidMount() {
    this.element = this.node.parentNode;
    const content = document.querySelector(`#${this.element.dataset.field}`).value;

    if (content !== '') {
      this.setState({editorState: EditorState.createWithContent(convertFromRaw(JSON.parse(content)))});
    }
  }

  onBlur() {
    document.querySelector(`#${this.element.dataset.field}`).value = JSON.stringify(convertToRaw(this.editorState.getCurrentContent()));
  }

  render() {
    const { editorState } = this.state,
      contentState = editorState.getCurrentContent();

    // If the user changes block type before entering any text, we can
    // either style the placeholder or hide it. Let's just hide it now.
    let className = 'RichEditor-editor';

    if (!contentState.hasText()) {
      if (contentState.getBlockMap().first()
        .getType() !== 'unstyled') {
        className += ' RichEditor-hidePlaceholder';
      }
    }

    return (
      <div className="RichEditor-root" ref={(node) => {
        this.node = node;
      }} >
        <BlockStyleControls
          editorState={editorState}
          onToggle={this.toggleBlockType}
        />
        <InlineStyleControls
          editorState={editorState}
          onToggle={this.toggleInlineStyle}
        />
        <div className={className} onClick={this.focus}>
          <Editor
            blockStyleFn={RichEditor.getBlockStyle}
            customStyleMap={this.styleMap}
            editorState={editorState}
            handleKeyCommand={this.handleKeyCommand}
            keyBindingFn={this.mapKeyToEditorCommand}
            onChange={this.onChange}
            onBlur={this.onBlur}
            element={this.element}
            ref={(c) => {
              this.editor = c;
            }}
            spellCheck={true}
          />
        </div>
      </div>
    );
  }

}

document.querySelectorAll('.draftjs').forEach((element) => {
  ReactDOM.render(
    <RichEditor />,
    element
  );
});