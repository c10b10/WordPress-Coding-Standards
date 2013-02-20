<?php

/**
 * WordPress Coding Standard
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    John Godley
 */

/**
 * WordPress_Sniffs_Files_FileNameSniff.
 *
 * Ensures filenames do not contain underscores
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    John Godley
 */
 
class WordPress_Sniffs_Files_FileNameSniff implements PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(
                T_OPEN_TAG,
               );

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in the
     *                                        stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        // Make sure this is the first PHP open tag so we don't process
        // the same file twice.
        $prevOpenTag = $phpcsFile->findPrevious(T_OPEN_TAG, ($stackPtr - 1));
        if ($prevOpenTag !== false) {
            return;
        }

        $fileName  = basename($phpcsFile->getFileName());
		/** c10b10. Allow files that start with underscore. */
        if ((strpos($fileName, '_') !== false) && (strpos($fileName, '_') !== 0) ) {
				$expected = str_replace('_', '-', $fileName);
                $error = ucfirst('Filename "'.$fileName.'" with underscores found; use '.$expected.' instead');
                $phpcsFile->addError($error, $stackPtr);
        }

    }//end process()


}//end class


?>
